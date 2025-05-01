# Autoavaluació

This is a project I developed about a year ago, and I’d like to briefly explain what it’s about. Please note that the program's interface is in Catalan rather than English.

The program is designed for an educational center, where users can log in with different roles: student, teacher, or administrator. Each role has different permissions.

Administrators have full access to the system. They can manage users by adding, removing, or editing their information (such as names, passwords, and other personal data). They can also handle user registrations and deletions.

Teachers can view the self-evaluations submitted by students in their assigned subject. For example, if a teacher is assigned to only one subject, they will only have access to the evaluations related to that specific subject. These evaluations are completed by the students themselves, who assess their performance on a specific topic from the syllabus. They rate themselves on a scale from 0 to 3 based on various criteria related to that topic.

Students, on the other hand, can complete these self-assessments for each topic, evaluating themselves from 0 to 3 based on predefined aspects.

The project was built using Laravel, along with Vue.js, Blade, and PHP. The system works well overall, although there are still some features that could be added (it wasn’t required to include every possible feature, only the most essential ones). The design wasn’t a priority — it’s quite basic and was mainly built to demonstrate functionality. Some components, like “Mòduls”, are not yet implemented and are currently displayed in the same way as “Cicles”, just to showcase the basic structure and functionality.

If you'd like to try it out, you can log in using the following accounts:

adminuser - Password: 1234 (ADMIN ROLE)
ffernandez - Password: 1234 (TEACHER ROLE)
mplateror - Password: 1234 (STUDENT ROLE)

Thanks for reading this and I hope you find the project interesting!
