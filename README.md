# Autoavaluació

This is a project I developed entirely on my own about a year ago, and I would like to briefly present its purpose and functionality. Please note that the program's interface is in Catalan rather than English.

The application is designed for use in an educational setting, where users can log in with one of three roles: student, teacher, or administrator. Each role has distinct permissions and access levels:

- Administrators have full control over the system. They can manage user data (including adding, editing, and removing users) as well as handle registration and account deactivation. Administrators can also assign students and teachers to modules, manage learning outcomes (resultats d'aprenentatge) and evaluation criteria (criteris d’avaluació), and access all sections of the platform.

- Teachers can view the self-evaluations submitted by students in the modules assigned to them. For example, if a teacher is responsible for only one subject, they will only see the evaluations related to that specific module. These evaluations are performed by the students themselves, who assess their understanding and performance on specific topics from the syllabus. The self-assessment uses a scale from 0 to 3, based on various predefined criteria.

- Students can perform self-assessments for each module in which they are enrolled. These evaluations help them reflect on their strengths and areas for improvement in relation to learning outcomes. The goal is to actively involve students in their own learning process, in line with the pedagogical principles of self-evaluation.

The concept of self-assessment (autoevaluació), as implemented in this application, is based on educational methodologies that promote reflection, autonomy, and personal development. It encourages students to identify their own progress and learning gaps, making them more engaged and responsible for their academic performance.

This program was developed 100% by me, from start to finish. It showcases both backend and frontend integration, along with user authentication and role-based access control.

The project was built using: 

- Backend: PHP, Laravel (PHP framework), Eloquent, MySQL, APIs and Authentication & authorization logic.

- Frontend: HTML, CSS, JavaScript, Vue.js (JavaScript framework), Blade and Bootstrap.

The system functions well overall, although not all possible features have been implemented, as the goal was to focus on the essential functionalities required by the assignment.

The design is intentionally minimalistic, prioritizing functionality over visual appeal. Some components, such as Mòduls, are not fully implemented and are currently displayed similarly to Cicles, mainly to demonstrate the structure and workflow of the application.

To fully explore the platform’s features, I recommend logging in under each role and testing the different available functionalities. You can log in using the following accounts:

adminuser - Password: 1234 (ADMIN ROLE)
ffernandez - Password: 1234 (TEACHER ROLE)
mplateror - Password: 1234 (STUDENT ROLE)

Thanks for reading this and I hope you find the program interesting!
