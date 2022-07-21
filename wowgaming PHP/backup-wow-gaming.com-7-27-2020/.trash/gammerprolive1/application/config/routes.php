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
$route['default_controller'] = '';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['admin/login'] 		= 		"admin/LoginController/loginView";
$route['admin/dashboard'] 	= 		"admin/Dashboard/dashboard";

/*Master Game Routes*/
$route['admin/master/create-game'] 	= 		"admin/MasterController/gameView";
$route['admin/master/rules-master'] 	= 		"admin/MasterController/rulePageView";
$route['admin/master/upload-image'] 	= 		"admin/MasterController/uploadGameImage";
$route['admin/master/manage-filter-list'] 	= 		"admin/MasterController/getFilterList";
$route['admin/master/edit-filter-details'] 	= 		"admin/MasterController/editFilterDetails";
$route['admin/master/update-filter-details'] 	= 		"admin/MasterController/updateFilterDetails";



/*User Routes*/
$route['admin/users/listing'] 	= 		"admin/UserController/userListingView";
/*Privacy & Policy Page*/
$route['admin/pages/privacy-policy'] 	= 		"admin/PageController/privacyPolicyView";
$route['admin/pages/terms-and-condition'] 	= 		"admin/PageController/termsConditionView";
$route['admin/pages/contact-us'] 	= 		"admin/PageController/contactUsView";
/*Withdrawal Rooutes*/
$route['admin/withdrawal/listing'] 	= 		"admin/WithdrawalController/viewWithdrawal";
$route['admin/withdrawal/getWithdarwalDataById/(:any)'] 	= 		"admin/WithdrawalController/viewWithdrawal/$1";

$route['admin/withdrawal/user-statistic'] 	= 		"admin/WithdrawalController/userStatistic";
$route['admin/transaction/get-withdrawal-details'] = "admin/WithdrawalController/getWithdrawalDetails";

/*Transaction listing*/
$route['admin/transaction/tranaction-listing'] 	= 		"admin/TransactionController/transactionView";
$route['admin/transaction/view-wallet-transaction-listing'] = "admin/TransactionController/viewWalletTransactionList";

/* Match Controller */
$route['admin/match/match-list'] = "admin/MatchController/matchList";
$route['admin/match/add-match'] = "admin/MatchController/addMatch";
$route['admin/master/get-filter-details'] 	= 		"admin/MatchController/getFilterDetails";
/*
    For webservices
*/
$route['webservices/get-gamelist'] = "webservices/Game/getGameList";
$route['webservices/user-registration'] = "webservices/Users/userRegister";
$route['webservices/terms-conditions'] = "webservices/Users/getTermsConditions";
$route['webservices/privacy-policy'] = "webservices/Users/getPrivacyPolicy";
$route['webservices/user-verification'] = "webservices/Users/userVerification";
$route['webservices/reset-password'] = "webservices/Users/resetPassword";
$route['webservices/login'] = "webservices/Users/userLogin";
$route['webservices/get-matchlist'] = "webservices/Match/matchList";
$route['webservices/get-filterlist'] = "webservices/Match/filterList";
$route['webservices/create-team'] = "webservices/Team/createTeam";
$route['webservices/get-assign-team'] = "webservices/Team/getAssignTeam";
$route['webservices/create-wallet-transaction'] = "webservices/Wallet/createWalletTransaction";
$route['webservices/wallet-transaction-history'] = "webservices/Wallet/walletTransactionHistory";
$route['webservices/winning-loss-match-update'] = "webservices/Team/winningLossMatchUpdate";
$route['webservices/user-match-history'] = "webservices/Team/userMatchHistory";
$route['webservices/update-profile-image'] = "webservices/Users/updateProfileImage";
$route['webservices/wallet-withdrawal-request'] = "webservices/Wallet/walletWithdrawalRequest";
$route['webservices/update-match-play-status'] = "webservices/Team/updateMatchPlayStatus";
/*
    End webservices
    
*/