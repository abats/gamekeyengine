angular
    .module('gkeApp.services', [])
    .factory('gamesService', gamesService);


gamesService.$inject = ['$http']

function gamesService($http) {

    var api = 'http://localhost:8000/api/games';
    gamesService = {};

    gamesService.search = function (query) {
        return $http.get(api + '/search/' + query);
    }

    return gamesService;
}