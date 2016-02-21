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
            controller: function (gamesService) {

                $inject = ['gamesService'];

                function increment() {
                    this.count++;
                }
                function decrement() {
                    this.count--;
                }
                this.increment = increment;
                this.decrement = decrement;

                gamesService.search('batman').success(function(response){
                    console.log(response);
                }).error(function(response){
                    console.log('bingbangerrordingdong');
                });
            },
            templateUrl : 'js/app/modules/games/components/games-browse.html'

        });

})();