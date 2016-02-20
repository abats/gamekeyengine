(function () {
    angular
        .module('gkeApp.games', [])

        .controller('GamesCtrl', function GamesCtrl() {
            this.count = 4;
        })

        .component('games', {
            bindings: {
                count: '='
            },
            controller: function () {
                function increment() {
                    this.count++;
                }
                function decrement() {
                    this.count--;
                }
                this.increment = increment;
                this.decrement = decrement;
            },
            templateUrl : 'js/app/modules/games/components/games.html'
        });

})();