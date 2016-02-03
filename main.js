angular.module('myApp', ['ngMaterial'])
        .controller('AppCtrl', function ($scope, $mdToast,$http) {
            $scope.showSimpleToast = function ($event) {
                var person = $scope.person;
                var name = person.name;
                var email = person.email;
                $http({
                    method: 'GET',
                    url: 'index.php?sub=1&name='+name+'&email='+email+' '
                }).then(function successCallback(response) {
                    //alert(response.data);
                    if(response.data == '1'){
                        var message = 'Подписка успешно оформлена';
                    }else{
                        var message = 'Введите корректные данные';
                    }
                    $mdToast.show($mdToast.simple().textContent(message).hideDelay(3000).position('top right'));

                }, function errorCallback(response) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
                
            };
        })
        .controller('feedback', function ($scope, $mdDialog, $mdToast) {
            $scope.showConfirm = function ($event) {
                $mdDialog.show({
                    targetEvent: $event,
                    template:
                            '<md-dialog>' +
                            '  <md-dialog-content style="margin-left:20px;margin-top:20px;margin-right:20px"><p >Ваше имя</p><input ng-model="feedback.name" type="text"><br><p>Напишите ваше сообщение<br><textarea rows="5" ng-model="feedback.text"  cols="80"></textarea><p><br></md-dialog-content>' +
                            '  <md-dialog-actions>' +
                            '    <md-button ng-click="closeDialog()" class="md-primary">' +
                            '      Отмена' +
                            '    </md-button>' +
                            '    <md-button ng-click="closeDialogSend()" class="md-primary">' +
                            '      Отправить' +
                            '    </md-button>' +
                            '  </md-dialog-actions>' +
                            '</md-dialog>',
                    controller: 'feedback',
                    onComplete: afterShowAnimation,
                    locals: {employee: $scope.userName}
                });
                // When the 'enter' animation finishes...
                function afterShowAnimation(scope, element, options) {
                    // post-show code here: DOM element focus, etc.
                }
            }
            $scope.closeDialogSend = function () {
                // Easily hides most recent dialog shown...
                // no specific instance reference is needed.
                var feedback = $scope.feedback;
                //send message this
                $mdDialog.hide();
                $mdToast.show($mdToast.simple().textContent('Сообщение успешно отпралено').hideDelay(3000).position('top right'));


            };
            $scope.closeDialog = function () {
                // Easily hides most recent dialog shown...
                // no specific instance reference is needed.
                $mdDialog.hide();

            };
        });

        