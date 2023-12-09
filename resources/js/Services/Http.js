import axios from "axios";

export default axios.create({
    baseURL: 'http://daya-micro-art.test',
    headers: {
        "Content-type": "application/json"
    }
});
