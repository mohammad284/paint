const app = require('express')()
const http = require('http').createServer(app)
app.get('/', (req, res) => {
   res.send("Node Server is running. Yay!!")
})
http.listen(process.env.PORT)