import axios from 'axios';

const postApi=(url, payLoad)=>{
	console.log("URL ", url);
	console.log("payLoad ", payLoad);
    axios.post(url, payLoad).then((response)=>{
        console.log("Response after post of Payload is :", response)
    }).catch(error=>{
        console.log("**Error** occured after post of Payload is :", error)
    })
}

export default postApi;