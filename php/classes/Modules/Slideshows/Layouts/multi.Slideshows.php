<div class="slideshows" ng-app="Impress" ng-controller="slideshowController">
    <a ng-repeat="show in slideshows" class="block" href="slides?show={{ show.itemid }}">
        <h1>{{ show.title }}</h1>
        <img ng-src="{{ show.image }}">
        <div class="desc">{{ show.description }}</div>
    </a>
<a class="link block" href="module/">Voeg zelf een slideshow toe!</a>
</div>
