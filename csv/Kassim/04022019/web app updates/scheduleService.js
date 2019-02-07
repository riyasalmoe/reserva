'use strict';
app.factory('scheduleService', ['$http', function ($http) {

    var serviceBase = '/ReservaIntegrationapi/';
    var scheduleServiceFactory = {};

    var _getRecordDetails = function (floorname,pagesize) {
        return $http.get(serviceBase + 'schedules/records/' + floorname + '/' + pagesize).then(function (results) {
            return results;
        });
    };

    var _getRecordList = function (floorname,pagesize, pagenumber) {
        return $http.get(serviceBase + 'schedules/list/' + floorname + '/' + pagesize + '/' + pagenumber).then(function (results) {
            return results;
        });
    };

    scheduleServiceFactory.getRecordDetails = _getRecordDetails;
    scheduleServiceFactory.getRecordList = _getRecordList;
    
    return scheduleServiceFactory;

}]);