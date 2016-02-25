(function () {

    angular
        .module('gkeApp.services', [])
        .factory('gameService', gameService);

    gameService.$inject = ['$http'];

    function gameService($http) {
        var api = 'http://localhost:8000/api/games';

        return {
            getTop: getTop,
            search: search
        };

        function search(query) {
            return $http.get(api + '/search/' + query)
                .then(getSearchComplete)
                .catch(getSearchFailed);

            function getSearchComplete(response) {
                console.log('search complete')
                console.log(response.data);

                return response.data;
            }

            function getSearchFailed(error) {
                logger.error('fail: ' + error.data);
            }
        }

        function getTop() {
            return $http.get(api + '/top')
                .then(getTopComplete)
                .catch(getTopFailed);

            function getTopComplete(response) {
                return response.data;
            }

            function getTopFailed(error) {
                logger.error('fail: ' + error.data);
            }
        }
    }

})();
