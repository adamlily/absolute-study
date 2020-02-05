<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 	= 'index';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

/***** Admin : Routes Start *****/

/***** Login Route*****/
$route['user-login'] 			= 'index/userLogin';
$route['logout'] 				= 'index/logout';

/***** Dashboard Route*****/
$route['admin/dashboard'] = 'dashboard';

/***** Master Route*****/
$route['admin/sector-list'] 	= 'master/sectorList';

$route['admin/board-list'] 	= 'master/boardList';
$route['admin/add-board'] 	= 'master/addBoard';
$route['admin/del-board-list'] 	= 'master/delBoardList';

$route['admin/class-list'] 	= 'master/classList';
$route['admin/add-classlist'] 	= 'master/addClassList';
$route['admin/del-class-list'] 	= 'master/delClassList';
$route['admin/get-class-details'] 	= 'master/getClassDetails';


$route['admin/subject-list'] 	= 'master/subjectList';
$route['admin/add-subject-list'] 	= 'master/addSubjectList';
$route['admin/get-subject-details'] 	= 'master/getSubjectDetails';

$route['admin/unit-list'] 	= 'master/unitList';
$route['admin/add-unit-list'] 	= 'master/addUnitList';
$route['admin/chapter-list'] 	= 'master/chapterList';
$route['admin/add-chapter-list'] 	= 'master/addChapterList';

$route['admin/add-sector'] 			= 'master/addNewSector';
$route['admin/job-role-list'] 	= 'master/jobRoleList';
$route['admin/add-job-role'] 			= 'master/addNewJobRole';
$route['admin/section-list'] 		= 'master/sectionList';
$route['admin/add-section'] 			= 'master/addNewSection';

/***** Quiz Routes*****/
$route['admin/import-question-view'] = 'quiz/importQuestionView';
$route['admin/import-question'] = 'quiz/importNewQuestion';
$route['admin/question-list'] 		= 'quiz/questionList';
$route['admin/add-question-view'] 	= 'quiz/addQuestionView';
$route['admin/add-question'] 		= 'quiz/addNewQuestion';
$route['admin/quiz-list'] 			= 'quiz/quizList';
$route['admin/create-new-quiz'] 	= 'quiz/createNewQuiz';
$route['admin/save-new-quiz'] 		= 'quiz/saveNewQuiz';
$route['admin/attempt-quiz'] 		= 'quiz/attemptQuiz';
$route['admin/submit-quiz'] 		= 'quiz/saveSubmittedQuiz';
$route['current-attempted-quiz/(:any)'] 	= 'quiz/currentAttemptedQuiz/$1';
$route['admin/submitted-quiz'] 		= 'quiz/submittedQuizList';
$route['admin/quiz-result/(:any)']  =  'quiz/quizResult/$1';
$route['admin/select-question'] 		= 'quiz/selectQuestion';
$route['admin/select-question-list'] 		= 'quiz/selectQuestionList';




/***** Student Routes*****/
$route['admin/import-student-view'] 		= 'student/importStudentView';
$route['admin/student-sample-sheet/(:any)'] = 'student/studentSampleSheetDownload/$1';
$route['admin/import-student-data'] 		= 'student/importStudentData';
$route['admin/student-list'] 				= 'student/studentList';
$route['admin/allocate-quiz-to-student'] 	= 'student/allocateQuizToStudent';
$route['admin/allocate-to-student'] 	= 'student/quizAllocated';


/***** AJAX Request Routes *****/
$route['get-job-role-list-by-sector'] 			= 'ajax/getJobRoleListBySectorId';
$route['get-job-role-list-by-sector-job-role'] 	= 'ajax/getSectionListBySectorAndJobRoleId';
$route['get-question-details'] 					= 'ajax/getQuestionDetailsById';

/***** Admin : Routes End *****/


/***** Student : Routes Start *****/

/***** Dashboard Routes*****/
$route['student/dashboard']					= 'dashboard/studentDashboard';

/***** Quiz Routes*****/
$route['student/quiz-list']					= 'quiz/studentQuizList';
$route['student/attempt-quiz']				= 'quiz/attemptQuiz';
$route['student/current-attempted-quiz/(:any)'] 	= 'quiz/currentAttemptedQuiz/$1';

/***** Student : Routes End *****/