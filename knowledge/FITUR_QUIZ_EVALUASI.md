# 📝 Fitur Quiz & Evaluasi Pembelajaran

## ✅ Implementasi Selesai

### 🗄️ Database Structure

#### 1. **Tabel `quizzes`** (Updated)
```sql
- id
- program_id (FK to programs)
- title
- description
- order
- duration_minutes (default: 30)
- passing_score (default: 70%)
- max_attempts (default: 3)
- show_answers (boolean)
- shuffle_questions (boolean)
- gform_url (nullable) - untuk backward compatibility
```

#### 2. **Tabel `questions`** (New)
```sql
- id
- quiz_id (FK to quizzes)
- type (enum: 'multiple_choice', 'short_answer', 'essay')
- question (text)
- options (json) - untuk pilihan ganda
- correct_answer (text) - untuk auto-grading
- points (default: 10)
- order
- explanation (text, nullable)
```

#### 3. **Tabel `quiz_attempts`** (New)
```sql
- id
- quiz_id (FK to quizzes)
- user_id (FK to users)
- score
- total_points
- percentage
- passed (boolean)
- started_at
- completed_at
- time_taken_seconds
- attempt_number
```

#### 4. **Tabel `question_answers`** (New)
```sql
- id
- quiz_attempt_id (FK to quiz_attempts)
- question_id (FK to questions)
- user_answer (text)
- is_correct (boolean)
- points_earned
- feedback (text, nullable)
```

---

## 🎯 Fitur yang Tersedia

### 1. **Kelola Quiz (Admin)**
- ✅ Create/Edit/Delete quiz
- ✅ Set durasi pengerjaan (menit)
- ✅ Set nilai passing score (%)
- ✅ Limit maksimal percobaan
- ✅ Toggle tampilkan jawaban benar
- ✅ Toggle acak soal
- ✅ Support Google Form (optional)

### 2. **Kelola Soal (Admin)**
- ✅ **Tipe Soal:**
  - **Pilihan Ganda** (Multiple Choice)
    - Minimal 2, maksimal 6 pilihan
    - Auto-grading
  - **Isian Singkat** (Short Answer)
    - Auto-grading (case-insensitive)
  - **Essay/Uraian** (Essay)
    - Manual grading (untuk nanti)
- ✅ Set poin per soal
- ✅ Add explanation (penjelasan)
- ✅ Drag & drop reorder soal

### 3. **Penilaian Otomatis**
- ✅ Auto-grading untuk Multiple Choice & Short Answer
- ✅ Hitung total score otomatis
- ✅ Hitung percentage
- ✅ Tentukan passed/failed berdasarkan passing_score
- ✅ Tracking waktu pengerjaan

### 4. **Riwayat Quiz**
- ✅ Simpan semua attempt user
- ✅ Track attempt number
- ✅ Simpan jawaban user per question
- ✅ Simpan score & percentage

---

## 📋 Models & Relationships

### Quiz Model
```php
- hasMany: questions
- hasMany: attempts
- belongsTo: program
```

### Question Model
```php
- belongsTo: quiz
- hasMany: answers
- Method: checkAnswer($userAnswer)
```

### QuizAttempt Model
```php
- belongsTo: quiz
- belongsTo: user
- hasMany: questionAnswers
- Method: calculateScore()
```

### QuestionAnswer Model
```php
- belongsTo: quizAttempt
- belongsTo: question
```

---

## 🎨 Filament Admin Interface

### Routes
```
/admin/quizzes - List quiz
/admin/quizzes/create - Create quiz
/admin/quizzes/{id}/edit - Edit quiz
/admin/quizzes/{id}/questions - Manage soal
```

### Fitur Admin:
1. **Quiz Table**
   - Sortable columns
   - Filter by program
   - Show total soal & attempts
   - Quick action "Kelola Soal"

2. **Question Manager**
   - Form dynamic berdasarkan tipe soal
   - Repeater untuk pilihan ganda
   - Validation per tipe
   - Reorderable dengan drag & drop

---

## 🔄 Flow Pengerjaan Quiz (Untuk Frontend Nanti)

### 1. Start Quiz
```php
QuizAttempt::create([
    'quiz_id' => $quizId,
    'user_id' => $userId,
    'started_at' => now(),
    'attempt_number' => $attemptNumber,
    'total_points' => $quiz->questions->sum('points'),
]);
```

### 2. Submit Answer
```php
$questionAnswer = QuestionAnswer::create([
    'quiz_attempt_id' => $attemptId,
    'question_id' => $questionId,
    'user_answer' => $answer,
]);

// Auto-grade if not essay
if ($question->type !== 'essay') {
    $isCorrect = $question->checkAnswer($answer);
    $questionAnswer->update([
        'is_correct' => $isCorrect,
        'points_earned' => $isCorrect ? $question->points : 0,
    ]);
}
```

### 3. Finish Quiz
```php
$attempt->update([
    'completed_at' => now(),
    'time_taken_seconds' => now()->diffInSeconds($attempt->started_at),
]);
$attempt->calculateScore();
```

---

## 🎓 Contoh Usage

### Admin: Create Quiz dengan Soal
```
1. Buat Quiz baru
2. Set durasi: 30 menit
3. Set passing score: 70%
4. Klik "Kelola Soal"
5. Tambah soal:
   - Tipe: Pilihan Ganda
   - Pertanyaan: "Apa ibukota Indonesia?"
   - Pilihan: Jakarta, Bandung, Surabaya, Medan
   - Jawaban benar: Jakarta
   - Poin: 10
```

### User: Mengerjakan Quiz (Frontend)
```
1. Lihat quiz yang tersedia
2. Klik "Mulai Quiz"
3. Timer mulai berjalan
4. Jawab soal satu per satu
5. Submit quiz
6. Lihat hasil & score otomatis
7. Jika show_answers = true, lihat jawaban benar
```

---

## 📊 Validasi & Batasan

### Quiz
- ✅ Duration: minimal 1 menit
- ✅ Passing score: 0-100%
- ✅ Max attempts: minimal 1

### Question
- ✅ Multiple Choice: 2-6 pilihan
- ✅ Correct answer required (kecuali essay)
- ✅ Points: minimal 1

### Quiz Attempt
- ✅ Check max attempts sebelum mulai
- ✅ Validate time limit saat submit

---

## 🚀 Next Steps (Frontend Implementation)

### 1. User Interface
- [ ] Quiz list page
- [ ] Quiz detail & start page
- [ ] Quiz taking interface with timer
- [ ] Submit & result page
- [ ] Quiz history page

### 2. API Endpoints (Laravel)
- [ ] GET /api/quizzes - List available quizzes
- [ ] POST /api/quizzes/{id}/start - Start attempt
- [ ] POST /api/quizzes/{id}/submit - Submit answers
- [ ] GET /api/quizzes/attempts - User's history
- [ ] GET /api/quizzes/attempts/{id} - Attempt detail

### 3. Manual Grading (Essay)
- [ ] Admin page untuk review essay answers
- [ ] Grade essay & add feedback
- [ ] Notify user setelah grading

---

## 💡 Best Practice yang Diterapkan

1. ✅ **Normalisasi Database** - Terpisah quiz, questions, attempts, answers
2. ✅ **Auto-grading** - Multiple choice & short answer otomatis
3. ✅ **Flexible** - Support 3 tipe soal berbeda
4. ✅ **Tracking** - Semua attempt & jawaban tersimpan
5. ✅ **Scalable** - Easy to add more question types
6. ✅ **Backward Compatible** - Google Form masih bisa digunakan

---

## 📝 Catatan Penting

### Untuk Developer:
- Model relationships sudah lengkap
- Migrations sudah dijalankan
- Filament admin fully functional
- Tinggal implement frontend user

### Untuk Testing:
1. Login admin: `/admin`
2. Navigate ke "Quiz & Evaluasi"
3. Create quiz baru
4. Add questions (test semua tipe)
5. Test validation & reordering

---

## 🔧 Troubleshooting

### Issue: Foreign key constraint error
**Solution:** Migrations sudah diupdate dengan proper order

### Issue: Icon not found
**Solution:** Use `Heroicon::Outlined*` bukan `Heroicon::Outline*`

### Issue: Form vs Schema
**Solution:** Filament menggunakan `Schema` untuk RelatedRecords

---

## 📞 Support

Jika ada pertanyaan atau butuh fitur tambahan:
1. Essay manual grading
2. Timer frontend
3. Analytics & statistics
4. Export hasil quiz
5. Certificate generation

Semua bisa ditambahkan dengan mudah karena struktur database sudah solid! 🎉
