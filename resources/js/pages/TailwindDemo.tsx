import { Head } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

export default function TailwindDemo() {
    return (
        <div className="min-h-screen bg-neutral-50 p-8 dark:bg-neutral-950">
            <Head title="Tailwind & Shadcn Demo" />
            <div className="mx-auto max-w-2xl space-y-8">
                <div className="space-y-2 text-center">
                    <h1 className="text-3xl font-bold tracking-tighter text-neutral-900 dark:text-neutral-50">
                        Tailwind CSS & Shadcn UI
                    </h1>
                    <p className="text-neutral-500 dark:text-neutral-400">
                        If you can see this styled page, your setup is working
                        correctly!
                    </p>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Interactive Demo</CardTitle>
                        <CardDescription>
                            Try interacting with these components.
                        </CardDescription>
                    </CardHeader>
                    <CardContent className="space-y-4">
                        <div className="space-y-2">
                            <Label htmlFor="name">Name</Label>
                            <Input id="name" placeholder="Enter your name" />
                        </div>
                        <div className="flex gap-2">
                            <Button>Default Button</Button>
                            <Button variant="secondary">Secondary</Button>
                            <Button variant="destructive">Destructive</Button>
                            <Button variant="outline">Outline</Button>
                            <Button variant="ghost">Ghost</Button>
                            <Button variant="link">Link</Button>
                        </div>
                    </CardContent>
                    <CardFooter className="justify-between">
                        <p className="text-sm text-neutral-500">
                            Built with Laravel, Inertia, React, & Tailwind.
                        </p>
                        <Button variant="default">Action</Button>
                    </CardFooter>
                </Card>

                <div className="grid gap-4 md:grid-cols-3">
                    <div className="rounded-lg border bg-white p-4 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
                        <div className="mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                            >
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                        </div>
                        <h3 className="font-semibold">Tailwind v4</h3>
                        <p className="text-sm text-neutral-500">
                            Zero-config, high performance.
                        </p>
                    </div>
                    <div className="rounded-lg border bg-white p-4 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
                        <div className="mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                            >
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <h3 className="font-semibold">Shadcn UI</h3>
                        <p className="text-sm text-neutral-500">
                            Accessible, customizable components.
                        </p>
                    </div>
                    <div className="rounded-lg border bg-white p-4 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
                        <div className="mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 text-purple-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                            >
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <h3 className="font-semibold">Icons</h3>
                        <p className="text-sm text-neutral-500">
                            Lucide React icons included.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}
