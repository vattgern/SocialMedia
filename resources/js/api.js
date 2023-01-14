import axios from 'axios';

const api = axios.create();

api.interceptors.request.use(config=>{
    if(localStorage.getItem('token')){
        config.headers.authorization = `Bearer ${localStorage.getItem('token')}`
    }
    return config;
}, error => {

});

api.interceptors.response.use(
    config => {
        if(localStorage.getItem('token')){
            config.headers.authorization = `Bearer ${localStorage.getItem('token')}`
        }
        return config;
    },
    error => {
        // axios.post('api/auth/refresh', {}, {
        //     headers:{
        //         'Authorization': Bearer ${localStorage.getItem('accessToken')}
        //     }
        // }).then(response => {
        //     console.log(response);
        //     localStorage.setItem('accessToken', response.data.access_token);
        //     error.config.headers.authorization
        //         = Bearer ${response.data.access_token};
        //     return api.request(error.config);
        // })

    }
);
export default api;
