# 🗄️ Database Structure - Quiz System

## Entity Relationship Diagram

```
┌─────────────────────┐
│     PROGRAMS        │
│  (existing table)   │
│ ─────────────────── │
│ • id                │
│ • title             │
│ • description       │
└──────────┬──────────┘
           │
           │ 1:N
           ▼
┌─────────────────────┐
│      QUIZZES        │
│  (updated table)    │
│ ─────────────────── │
│ • id                │
│ • program_id (FK)   │
│ • title             │
│ • description       │
│ • duration_minutes  │◄──────┐
│ • passing_score     │       │
│ • max_attempts      │       │
│ • show_answers      │       │
│ • shuffle_questions │       │
│ • gform_url         │       │
│ • order             │       │
└──────────┬──────────┘       │
           │                  │
           │ 1:N              │ N:1
           ▼                  │
┌─────────────────────┐       │
│     QUESTIONS       │       │
│    (new table)      │       │
│ ─────────────────── │       │
│ • id                │       │
│ • quiz_id (FK) ─────┼───────┘
│ • type              │◄──────┐
│   - multiple_choice │       │
│   - short_answer    │       │
│   - essay           │       │
│ • question (text)   │       │
│ • options (json)    │       │
│ • correct_answer    │       │
│ • points            │       │
│ • order             │       │
│ • explanation       │       │
└──────────┬──────────┘       │
           │                  │
           │                  │ N:1
           │                  │
           │    ┌─────────────┴──────────┐
           │    │   QUESTION_ANSWERS     │
           │    │     (new table)        │
           │    │ ───────────────────── │
           │    │ • id                   │
           └────┼─• question_id (FK)     │
                │ • quiz_attempt_id (FK) │◄──────┐
                │ • user_answer          │       │
                │ • is_correct           │       │
                │ • points_earned        │       │
                │ • feedback             │       │
                └────────────┬───────────┘       │
                             │                   │
                             │ N:1               │
                             ▼                   │
                 ┌─────────────────────┐         │
                 │   QUIZ_ATTEMPTS     │         │
                 │    (new table)      │         │
                 │ ─────────────────── │         │
                 │ • id ───────────────┼─────────┘
                 │ • quiz_id (FK) ─────┼───┐
                 │ • user_id (FK) ─────┼─┐ │
                 │ • score             │ │ │
                 │ • total_points      │ │ │
                 │ • percentage        │ │ │
                 │ • passed            │ │ │
                 │ • started_at        │ │ │
                 │ • completed_at      │ │ │
                 │ • time_taken_sec    │ │ │
                 │ • attempt_number    │ │ │
                 └─────────────────────┘ │ │
                                         │ │
                                   N:1   │ │   N:1
                                         │ │
                         ┌───────────────┘ └──────────────┐
                         ▼                                 ▼
              ┌─────────────────────┐          ┌─────────────────────┐
              │      QUIZZES        │          │       USERS         │
              │  (linked above)     │          │  (existing table)   │
              └─────────────────────┘          │ ─────────────────── │
                                               │ • id                │
                                               │ • name              │
                                               │ • email             │
                                               └─────────────────────┘
```

## 🔄 Data Flow

### 1. Admin Creates Quiz
```
Admin → QuizResource → Quiz Model → DB
                    → Questions Table
```

### 2. User Takes Quiz
```
User Start
   ↓
QuizAttempt Created (started_at)
   ↓
User Answers Questions
   ↓
QuestionAnswer Created for each question
   ↓
Auto-grading (for multiple_choice & short_answer)
   ↓
User Submit
   ↓
QuizAttempt Updated (completed_at, score)
   ↓
Calculate: score, percentage, passed
   ↓
Show Results
```

## 📊 Key Features

### Auto-Grading Logic
```php
// Multiple Choice & Short Answer
if ($question->type !== 'essay') {
    $isCorrect = $question->checkAnswer($userAnswer);
    $pointsEarned = $isCorrect ? $question->points : 0;
}

// Essay (manual grading)
if ($question->type === 'essay') {
    $pointsEarned = null; // Admin grades later
}
```

### Score Calculation
```php
$totalScore = QuestionAnswer::where('quiz_attempt_id', $attemptId)
                            ->sum('points_earned');

$percentage = ($totalScore / $totalPoints) * 100;

$passed = $percentage >= $quiz->passing_score;
```

## 🎯 Query Examples

### Get User's Quiz History
```php
$attempts = QuizAttempt::where('user_id', $userId)
    ->with(['quiz', 'questionAnswers.question'])
    ->orderBy('created_at', 'desc')
    ->get();
```

### Get Quiz with All Questions
```php
$quiz = Quiz::with('questions')
    ->findOrFail($quizId);

if ($quiz->shuffle_questions) {
    $quiz->questions = $quiz->questions->shuffle();
}
```

### Check Remaining Attempts
```php
$attemptCount = QuizAttempt::where('quiz_id', $quizId)
    ->where('user_id', $userId)
    ->count();

$canAttempt = $attemptCount < $quiz->max_attempts;
```

### Get Leaderboard
```php
$leaderboard = QuizAttempt::where('quiz_id', $quizId)
    ->where('passed', true)
    ->with('user')
    ->orderBy('percentage', 'desc')
    ->orderBy('time_taken_seconds', 'asc')
    ->limit(10)
    ->get();
```

## 🔐 Validation Rules

### Quiz
- duration_minutes: min 1
- passing_score: 0-100
- max_attempts: min 1

### Question
- type: required, enum
- question: required, text
- options: required if multiple_choice
- correct_answer: required if not essay
- points: required, min 1

### Quiz Attempt
- Cannot exceed max_attempts
- Must have valid quiz_id & user_id
- started_at: required
- completed_at: nullable (filled when submit)

## 📈 Statistics Queries

### Quiz Statistics
```php
$stats = [
    'total_attempts' => $quiz->attempts()->count(),
    'total_users' => $quiz->attempts()->distinct('user_id')->count(),
    'average_score' => $quiz->attempts()->avg('percentage'),
    'pass_rate' => $quiz->attempts()->where('passed', true)->count() / $total * 100,
    'average_time' => $quiz->attempts()->avg('time_taken_seconds'),
];
```

### Question Analysis
```php
$questionStats = QuestionAnswer::where('question_id', $questionId)
    ->selectRaw('
        COUNT(*) as total_answers,
        SUM(is_correct) as correct_count,
        AVG(is_correct) * 100 as correct_percentage
    ')
    ->first();
```

## 🚀 Performance Optimization

### Indexes Created
```sql
-- Questions
INDEX (quiz_id, order)

-- Quiz Attempts
INDEX (user_id, quiz_id)
INDEX (quiz_id, completed_at)

-- Question Answers
INDEX (quiz_attempt_id, question_id)
```

### Eager Loading
```php
// Good
$attempts = QuizAttempt::with(['quiz', 'questionAnswers.question'])->get();

// Bad (N+1 problem)
$attempts = QuizAttempt::all();
foreach ($attempts as $attempt) {
    $attempt->quiz; // Additional query
}
```

## 🎨 JSON Structure

### Question Options (Multiple Choice)
```json
[
  "Jakarta",
  "Bandung",
  "Surabaya",
  "Medan"
]
```

### Future Enhancement: Rich Options
```json
[
  {
    "text": "Jakarta",
    "image": "path/to/image.jpg"
  },
  {
    "text": "Bandung",
    "image": "path/to/image2.jpg"
  }
]
```

---

**Created:** 2026-02-15  
**Version:** 1.0  
**Status:** Production Ready (Admin Side) ✅
