event_app.controller("main_controller", function($scope){
	var calendar = new calendar_object();
	$scope.get_event = function(date){// 1 - Passing date for title, 2 - 
		$scope.event_title = $scope.year + " Gada " + date + " " + $scope.month;//For correct title
		calendar.get_day_event(date);
	}
	$scope.next_month = function(){
		calendar.set_month(1);
		$scope.year = calendar.get_year();
		$scope.date = calendar.draw_calendar();
		$scope.month = calendar.month_notations[calendar.get_month()];
		$scope.active_month = calendar.get_month();
		$scope.active_year = calendar.get_year();
	}
	$scope.prev_month = function(){
		calendar.set_month(-1);
		$scope.year = calendar.get_year();
		$scope.date = calendar.draw_calendar();
		$scope.month = calendar.month_notations[calendar.get_month()];
		$scope.active_month = calendar.get_month();
		$scope.active_year = calendar.get_year();
	}
	$scope.today_year = calendar.today_year;
	$scope.today_month = calendar.today_month;
	$scope.today_date = calendar.today_date;
	$scope.active_month = calendar.get_month();
	$scope.active_year = calendar.get_year();
	$scope.year = calendar.get_year();
	$scope.date = calendar.draw_calendar();
	$scope.days_not = calendar.day_notations;
	$scope.month = calendar.month_notations[calendar.get_month()];
});
