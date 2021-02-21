const axios = require("axios");

const url = "https://xkcd.com/info.0.json";

axios
  .get(url)
  .then((res) => console.log(res.data))
  .catch((err) => console.log(err));
