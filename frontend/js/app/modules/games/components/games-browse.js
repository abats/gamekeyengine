(function () {
    angular
        .module('gkeApp.games')

        .controller('GamesBrowseCtrl', function GamesBrowseCtrl() {
            this.count = 4;
        })

        .component('gamesBrowse', {
            bindings: {
                count: '='
            },
            controller: function (gameService) {

                function increment() {
                    this.count++;
                }
                function decrement() {
                    this.count--;
                }
                this.increment = increment;
                this.decrement = decrement;

                var searchTest = gameService.search('batman');

                console.log(searchTest);
            },
            templateUrl : 'js/app/modules/games/components/games-browse.html'

        });

})();