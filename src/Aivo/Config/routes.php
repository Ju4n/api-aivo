<?php
// Routes
$app->map(['GET'], '/profile/facebook/{id}', 'Aivo\Controller\FacebookController:getProfileAction');
