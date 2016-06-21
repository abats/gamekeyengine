(function () {
    angular
        .module('gkeApp.games')

        .controller('GamesFrontpageListCtrl', function GamesFrontpageListCtrl() {
            this.games = {};
        })

        .component('gamesFrontpageList', {
            bindings: {
                count: '='
            },
            controller : gamesFrontPageListController,
            templateUrl : 'js/app/modules/games/components/games-frontpage-list.html'

        });

        function gamesFrontPageListController(gameService){
            var vm = this;

            init();

            function init(){
                gamesListServiceCall();
            }

            function gamesListServiceCall(){
                var gamesCall = gameService.getTop();
                gamesCall.then(function(data){
                    vm.games = data;
                })
            }
        }

})();