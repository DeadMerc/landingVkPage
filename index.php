<?php
//ini_set('display_errors', 1);
//$posts = json_decode(file_get_contents('https://api.vk.com/method/wall.get?owner_id=-99252033&count=6&filter=owner'));
include 'mysql.php';
$db = new SafeMySql();
if (isset($_GET['sub'])) {
    if (!empty($_GET['name']) AND ! empty($_GET['email'])) {
        $toBase['name'] = $_GET['name'];
        $toBase['email'] = $_GET['email'];
        if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'fail email';
        }
        $is = $db->query("INSERT INTO subs SET ?u", $toBase);
        if ($is) {
            echo 1;
        } else {
            echo 'fail instert';
        }
        die;
    }
}
?>
<html ng-app="myApp">
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- Angular Material CSS using GitCDN to load directly from `bower-material/master` -->
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/0.4.16/toaster.css">

        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body layout="column">
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <!-- Angular Material Dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-animate.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-aria.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-toaster/0.4.16/toaster.js"></script>

        <!-- Angular Material Javascript using GitCDN to load directly from `bower-material/master` -->
        <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.3/angular-material.min.js"></script>
        <script>
            function subscribe() {
                //var email = $("#email").val();
                //var name = $("#name").val();
                //$.get('index.php?sub=1&name='+name+'&email='+email+' ');
                $("#email").val('');
                $("#name").val('');

            }
        </script>
    <md-content>
        <div class="container header" ng-controller="feedback">Logo
            <div ng-click="showConfirm($event)" class="feedback">Написать нам</div>
            <hr></div>
        <div  class="container">
            <div  class="ng-scope">
                <md-content class="md-padding layout-wrap  layout-row" style="overflow: hidden;" layout="row" layout-wrap="" layout-align="center start">
                    <h1 style="">Заголовок<br>
                        <p>1 фывфывфывфывфывфывыфв</p>
                        <p>asdasdasdasdasasdasdasdas</p>
                        <p>asdasasdsadasdasdasdasddsa</p>
                    </h1>
                    <?php
                    $pinned_post = $db->getRow("SELECT * FROM posts WHERE is_pinned = '1'");
                    $posts = $db->getAll("SELECT * FROM posts WHERE is_pinned = '0' ORDER BY id ASC LIMIT 6");
                    echo '<div style="" flex="50"  class=" flex-50" >
                    <md-card>
                        ' . (1 == 1 ? '<md-card-header>
                            <md-card-title
                                <md-card-title-text>
                                   <span class="label label-primary">Лучшее</span>                              
                                </md-card-title-text>                                
                            </md-card-title> 
                        </md-card-header>' : '') . '
                        
                         
                        <md-card-content >
                            <img   height="300" width="500"  src="' . $pinned_post['img'] . '" class="md-card-image" alt="image caption">
                           
                            <p >
                                ' . substr($pinned_post['text'], 0, strpos($pinned_post['text'], ' ', 140)) . '...' . '
                            </p><br>
                        </md-card-content>
                        
                        <md-card-actions layout="row" layout-align="end center" class="layout-align-end-center layout-row">
                           <span style="margin-right: 68%;" class="glyphicon glyphicon-bullhorn" aria-hidden="true"> '.$pinned_post['reposts_count'].'</span>
                          <a href="http://vk.com/' . $pinned_post['link'] . '"><md-button class="md-raised md-primary md-button md-ink-ripple"> Участвую </md-button></a>
                        </md-card-actions>
                    </md-card>                        
                </div>';
                    for ($i = 0; $i < 6; $i++) {
                        if ($i == 0) {
                            echo '<div flex="100"  class=" flex-100"><md-card>

 <md-card-content  ng-controller="AppCtrl">
   <h2>Не пропусти самое интересное</h2>
   <p>Только самые лучшие конкурсы, без спама</p>
   <p><center>
   <md-input-container flex="20" style="margin-top: 40px; class="flex-20">
          <label for="input_22">Имя</label>
          <input  style="margin-bottom:23px;" id="name" ng-model="person.name"  class="ng-pristine ng-valid md-input ng-touched" id="input_22" aria-invalid="false" style="">
        </md-input-container>
    <md-input-container flex="20" class="flex-20" class="md-block md-input-has-messages md-input-has-value md-input-invalid">
        <label for="input_22">Почта</label>
        <input required="" type="email" id="email" name="clientEmail" ng-model="person.email" minlength="10" maxlength="100" ng-pattern="/^.+@.+\..+$/" class="md-input ng-invalid ng-valid-maxlength ng-dirty ng-invalid-email ng-valid-required ng-invalid-pattern ng-invalid-minlength ng-invalid-email-remove ng-touched" id="input_82" aria-required="false" aria-invalid="true" style="">

        <div ng-messages="projectForm.clientEmail.$error" role="alert" aria-live="assertive" class="ng-active">
          <!-- ngMessageExp: [\'required\', \'minlength\', \'maxlength\', \'pattern\'] --><div ng-message-exp="[\'required\', \'minlength\', \'maxlength\', \'pattern\']" class="ng-scope">
            Введите корректный email
          </div>
        </div>
      </md-input-container>   
    <md-button class="md-raised md-primary md-button md-ink-ripple" ng-click="showSimpleToast();" onclick="subscribe();"> Подписаться </md-button>
    </center></p>
 </md-card-content>
 
</md-card></div>';
                        }
                        echo '<div flex="33"  class=" flex-33">
                    <md-card >
                        ' . (0 == 1 ? '<md-card-header>
                            <md-card-title
                                <md-card-title-text>
                                   <span class="label label-primary">Лучшее</span>                              
                                </md-card-title-text>                                
                            </md-card-title> 
                        </md-card-header>' : '') . '
                        
                        <img height="300" width="300"  src="' . $posts[$i]['img'] . '" class="md-card-image" alt="image caption">
                        <md-card-content>
                            <p>
                                ' . substr($posts[$i]['text'], 0, strpos($posts[$i]['text'], ' ', 140)) . '...' . '
                            </p>
                        </md-card-content>
                        
                        <md-card-actions layout="row" layout-align="end center" class="layout-align-end-center layout-row">
                          <span style="margin-right: 55%;" class="glyphicon glyphicon-bullhorn" aria-hidden="true"> '.$posts[$i]['reposts_count'].'</span>
                          <a href="http://vk.com/' . $posts[$i]['link'] . '"><md-button class="md-raised md-primary md-button md-ink-ripple"> Участвую </md-button></a>
                           </md-card-actions>
                          
                    </md-card>                        
                </div>';
                    }
                    ?>

                </md-content>

            </div>
        </div>
        <script src="main.js"></script>
    </md-content>
</body>
</html>