'use strict';
app.controller('scheduleController', ['$interval','pagerService', '$state', '$rootScope', '$scope', '$location', '$mdSidenav', '$timeout', '$mdDialog', 'commonFunctions', 'scheduleService',
function ($interval,pagerService, $state, $rootScope, $scope, $location, $mdSidenav, $timeout, $mdDialog, commonFunctions, scheduleService) {
  
    $scope.floorname = '';
    var tempfloorname = $location.search().floorname;
    if (tempfloorname !== undefined && tempfloorname !== null) {
        $scope.floorname = tempfloorname;
    }

    //alert($scope.floorname);

    $scope.pagesize = 8;
    $scope.total_page_count = 0;
    $scope.current_pagenumber = 1;
    $scope.total_recordcount = 0;
    $scope.ngHideList = false;

    $scope.content = [];
   // $scope.content.push('');


    

    $rootScope.refreshData = function () {
        scheduleService.getRecordDetails($scope.floorname,$scope.pagesize).then(function (results) {
                var paginationDetails = results.data;
                $scope.total_recordcount = paginationDetails.RecordCount;
                $scope.total_page_count = paginationDetails.TotalPages;
                if ($scope.total_recordcount === 0) {
                    $scope.ngHideList = true;
                    $scope.pages = [];
                    return;
                }
                $scope.ngHideList = false;
                $scope.getData();
            });
    };

    $scope.updatepagesize = function (pagesize) {
        if ($scope.pagesize === pagesize)
            return;
        $scope.current_pagenumber = 1;
        $scope.pagesize = pagesize;
        $scope.refreshData();
    };

    $scope.pager = {};
    $scope.getData = function () {
        $scope.pager = pagerService.GetPager($scope.total_recordcount, $scope.current_pagenumber, $scope.pagesize);
        scheduleService.getRecordList($scope.floorname,$scope.pagesize, $scope.current_pagenumber).then(function (results) {
                $scope.content = results.data;
                $rootScope.content = results.data;
            })
        
    };

    $scope.setPageIndex = function (pagenumber) {
        if ($scope.total_recordcount === 0)
            return;

        if (pagenumber <= 0) return;
        if (pagenumber > $scope.total_page_count) return;

        $scope.current_pagenumber = pagenumber;
        $scope.getData();
    }
    
    $scope.currentDateTime = new Date();
    var runUpd = function () {
        var running = $interval(function () {
            //$scope.current_pagenumber = 1;
            //$scope.total_page_count = 0;
            $scope.currentDateTime = new Date();

            if ($scope.total_page_count == 0) { $scope.getData(); return; } 
            if ($scope.current_pagenumber + 1 > $scope.total_page_count) {
                $scope.current_pagenumber = 1;
            }
            else {
                $scope.current_pagenumber = $scope.current_pagenumber + 1;
            }


            $scope.getData();

        }, (1000 * 60));
        //delay milliseconds. 1 sec = 1000 miliseconds 
        //calling after every 120 sec.
    };

    $timeout(function () {
        $scope.refreshData();
        runUpd();

    }, 300);



}]);

