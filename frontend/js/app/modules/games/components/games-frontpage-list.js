(function () {
    angular
        .module('gkeApp.games')

        .controller('GamesFrontpageListCtrl', function GamesFrontpageListCtrl() {
            this.count = 4;
            this.games = {};
        })

        .component('gamesFrontpageList', {
            bindings: {
                count: '='
            },
            controller: function (gameService) {
                var vm = this;

                function increment() {
                    this.count++;
                }
                function decrement() {
                    this.count--;
                }
                this.increment = increment;
                this.decrement = decrement;

                var testCall = gameService.getTop();

                console.log(testCall);

                testCall.then(function(data){
                    vm.games = data;
                })

            },
            templateUrl : 'js/app/modules/games/components/games-frontpage-list.html'

        });

})();