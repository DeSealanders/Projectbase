angular.module('Impress', []).
    controller('slideshowController', function($scope, $http) {

        console.log('test');
        // Load scenarios from the back-end API
        $http.get("api")
            .success(function (response) {

                // Update scope with the API call response
                $scope.slideshows = response;
            });
    });