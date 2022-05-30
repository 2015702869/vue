import Qs from 'qs'
import axios from 'axios'
import VueCookies from 'vue-cookies'
axios.defaults.baseURL ='http://www.lime.com/';
axios.defaults.withCredentials=true;
axios.interceptors.request.use(
  config => {
    config.headers = {
      'Content-Type':'application/x-www-form-urlencoded'
    }
    if (config.push === '/index') { 

    } else { 
    if (VueCookies.get('accion')) { 
        config.headers.token=VueCookies.get('accion');   
      }   
    }  
    return config;
  },
  error => {
    return Promise.reject(err);
  }
);
axios.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    return Promise.reject(error)
  }
)
export default{
  post(url,data={}){
    return new Promise((resolve,reject) => {
      axios.post(url,Qs.stringify(data))
        .then(response => {
          resolve(response.data);
        },err => {
          reject(err)
        })
    })
  },
  get(url,params={}){
    return new Promise((resolve,reject) => {
      axios.get(url,{
        params:params
      })
        .then(response => {
          resolve(response.data);
        })
        .catch(err => {
          reject(err)
        })
    })
  }
}