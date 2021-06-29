# clash-of-clans-clanwebs
A simple way to get a real time self-updating Clan website through Clash of Clans API (v1). If the API is down or in maintenance, it will show a maintenance page.

Working example: https://losvencedores.ddns.net

Available in English and Spanish.

Distributed under Apache License 2.0. Do whatever you want with it, but don't remove credits.

## How to install
* In the first place you will need a hosting to upload it. You can find good free hostings if you look around, but that's up to you.
* Once you have a way to host it, you will need to edit _config.php_. Essential ones will be _$defaultLang_ to the default language of the website (_en_ for English and _es_ for Spanish), _$clanTag_ to your Clan tag (without the #) and _$apiKey_ to your Clash of Clans developer key.

## How to get a Clash of Clans developer key
* You will have to go to https://developer.clashofclans.com and register. Once you've done it, go to your name in the top right corner and into _My account_. Go to _Create a new key_, set any name and description, and add your host IP as allowed. You can ping your website domain in order to get it. Once created, copy the given API key and set it into _$apiKey_.

## How to add more languages
* You can add more languages editing _data/language.json_ and copying an existing one into a new one. Be careful with commas and including all the strings though.
* You can ask me to add those languages into the main branch if you want more people to use your translation; I will credit you.
---
If you found a bug or got any problem during the process, feel free to open an issue in the repository or contact me in any other way, but please, try by yourself before doing it.
