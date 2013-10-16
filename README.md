is_site_online
==============
is-site-online is a Software as a service project. User would be able to check if sites of their interest are online or offline. Users can register and have multiple sites tracked. The server would inform the user if their website is down.

Architecture
This project is a multi-tiered application.
The project is created using Codeigniter framework.


There are 3 main layers

REST SERVER: the web api uses Phil Sturgeon's rest library for codeigniter. The server returns json or xml for every endpoint.

WEBSITE: the website consumes the webapi to authenticate and perform crud activities.

WEBSITE JAVASCRIPT VERSION: not yet implemented. The javascript app will a single page application on backbone.js that will consume the restserver and provide same functionalities as the website.

ANDROID APP: not yet implemented but in near future, I plan to add an android app to consume the rest server and provide same functionalities as the website.
