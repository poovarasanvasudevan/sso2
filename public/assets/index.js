/**
 * Created by poovarasanv on 23/6/16.
 */

var app = angular.module('app', ['lumx'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('main', function ($scope) {

})

app.controller('login', function ($scope, $http, $window) {

    $scope.form = {};
    $scope.loginsubmit = function () {

        if (this.form.username.trim() == '') {
            $scope.error.username = true;
        }
        if (this.form.password.trim() == '') {
            $scope.error.password = true;

            return false;
        }

        $http({
            method: 'POST',
            url: '/login',
            data: $.param({
                username: this.form.username,
                password: this.form.password,
                remember: this.form.remember
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (data, status, headers, config) {
            if (data.result == 'success') {
                $window.location.href = '/dashboard';
            } else {
                $scope.result = 'Invalid Username or Password...'
            }
        }).error(function (data, status, headers, config) {
            $scope.result = 'Error in connection or server down...'
        });

    }
});

app.controller('dashboard', function ($scope, $http) {

    $http.get('/allartefacttype').success(function (data) {
        $scope.artefacttypes = data;
    }).error(function (data) {

    })
});

app.controller('definition', function ($scope, $http) {


    $scope.definition = {}
    $http.get('/alllocation')
        .success(function (data) {
            $scope.definition.alllocaction = data;
        }).error(function (data) {

        })

    $http.get('/allartefacttype')
        .success(function (data) {
            $scope.definition.allartefacttypes = data;
        }).error(function (data) {

        })
});

$(document).ready(function () {
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 0) {
            $('.toolbar').addClass('fixed');
        } else {
            $('.toolbar').removeClass('fixed');
        }
    });
});