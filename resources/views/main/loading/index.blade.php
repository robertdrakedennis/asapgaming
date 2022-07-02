<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style type="text/css">
    html,body {
        position: relative;
        width: 100%;
        height: 100%;
        margin: 0;
    }
    body {
        font-family: 'Oxygen', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #fff;
        background-color: #1a1a1a;
        background: -webkit-linear-gradient(45deg, #f527c7, #17c7f9);
        background: linear-gradient(45deg, #f527c7, #17c7f9);
    }

    #center {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 100%;
        text-align: center;
    }

    #logo-container {
        margin: auto;
        width: 15%;
        height: 15%;
        max-width: 250px;
        max-height: 250px;
        font-size: 0;
    }
    #logo {
        /* width: 100%; */
        opacity: 0;
        -webkit-filter: drop-shadow(0px 0px 4px rgba(0,0,0,.1));
        filter: drop-shadow(0px 0px 4px rgba(0,0,0,.1));
        -webkit-animation: fading ease-in-out 3s infinite;
        animation: fading ease-in-out 3s infinite;
    }

    #info {
        position: fixed;
        bottom: 15px;
        left: 10px;
    }
    #game-details {
        padding: 10px;
    }
    #game-details td {
        padding: 5px 0;
    }
    #game-details td:nth-child(2) {
        text-align: right;
        font-weight: 300;
    }

    @-webkit-keyframes fading {
        0% {opacity: 0;}
        20%,80% {opacity: 1;}
        100% {opacity: 0;}
    }
    @keyframes fading {
        0% {opacity: 0;}
        20%,80% {opacity: 1;}
        100% {opacity: 0;}
    }
</style>
<div id="center">
    <div id="logo-container">
        <img id="logo" src="{{ asset('assets/media/logo/color.svg') }}">
    </div>
</div>
<div id="info">
    <table id="game-details">
        <tbody>
        <tr>
            <td>Server:</td>
            <td id="server-name">AsapGaming</td>
        </tr>
        <tr>
            <td>Gamemode:</td>
            <td id="gamemode">DarkRP</td>
        </tr>
        <tr>
            <td>Map:</td>
            <td id="map">rp_downtown_asapgaming_v3</td>
        </tr>
        </tbody>
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="f9fd07b6551b37331e057f84-text/javascript"></script>
<script type="f9fd07b6551b37331e057f84-text/javascript">
			var files = {
				downloaded: 0,
				needed: 1
			};

			const gamemodes = {
				cinema: 'Cinema',
				demo: 'Demo',
				darkrp: 'DarkRP',
				deathrun: 'Deathrun',
				jailbreak: 'Jailbreak',
				melonbomber: 'Melon Bomber',
				militaryrp: 'MilitaryRP',
				murder: 'Murder',
				morbus: 'Morbus',
				policerp: 'PoliceRP',
				prophunt: 'Prophunt',
				sandbox: 'Sandbox',
				santosrp: 'SantosRP',
				schoolrp: 'SchoolRP',
				starwarsrp: 'SWRP',
				stopitslender: 'Stop it Slender',
				slashers: 'Slashers',
				terrortown: 'TTT',
			};


			function shuffle(array) {
				var i = 0, j = 0, temp = null;

				for (i = array.length - 1; i > 0; i -= 1) {
					j = Math.floor(Math.random() * (i + 1));
					temp = array[i];
					array[i] = array[j];
					array[j] = temp;
				}
			}

			function GameDetails(servername, serverurl, mapname, maxplayers, steamid, gamemode) {
				var gm_friendly_name = gamemode;
				if (typeof gamemodes[gamemode] !== 'undefined') {
					gm_friendly_name = gamemodes[gamemode];
				}

				document.getElementById('server-name').innerText = servername;
				document.getElementById('map').innerText = mapname;
				document.getElementById('gamemode').innerText = gm_friendly_name;
			}

			function SetFilesNeeded(needed) {
				files.needed = needed;
			}

			function DownloadingFile(fileName) {
				files.downloaded++;

				var progress = files.downloaded/files.needed;
				var percentage = Math.round(progress*100) + '%';

				if (isNaN(files.needed) || files.needed <= 0) {
					progress = 1;
					percentage = 'Loading...';
				}

				document.getElementById('percentage').innerText = percentage;
			}
		</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js" data-cf-nonce="f9fd07b6551b37331e057f84-" defer=""></script>
</body>
</html>
