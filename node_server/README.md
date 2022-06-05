**Install forever**

`npm install -g forever`

**Run Node server**

_Run following command from node_server folder._

`npm start`

**Add cronjob to auto start when restart:**

_To start editing run the following replacing the "testuser" with your desired runtime user for the node process. If you choose a different user other than yourself, you will have to run this with sudo._

`sudo crontab -u testuser -e`

_If you have never done this before, it will ask you which editor you wish to edit with. I like vim, but will recommend nano for ease of use._

**Once in the editor add the following line:**

`@reboot /usr/local/bin/forever start -c /usr/local/bin/node /your/path/to/your/app.js`