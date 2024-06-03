## Exam Management System

To set up the project in your local environment, please follow these steps:

1. Run 'composer install'
2. Run 'php artisan migrate'
3. Finally run 'php artisan serve' or navigate to the base URL for the output.

To access the admin panel for teachers, please visit http://base_url/teacher.


This project involves:-

User Roles:
1. Teacher
2. Student

--
1. Teacher Role Capabilities:
- Create exams with exam names.
- Add questions to exams, each with four choices.
- Consider one mark to each question.
- Set exam duration and pass marks.
- Can publish and archive exams.
- View exam results.

2. Student Role Capabilities:
- View details of the latest published exams on the website.
- Register to apply for exams.
- Attend exams within a predetermined time frame set in the backend. The system will automatically save exam results once the timer ends.
- Answer all questions (mandatory).
- View their pass/fail status after completing the exam.
- Can login to the application to see attended exams and marks.

## Laravel
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).