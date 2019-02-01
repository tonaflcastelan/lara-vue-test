class Auth {
    constructor() {

    }

    login (token, user) {        
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        this.token = token;
	    this.user = user;

	    Event.$emit('userLoggedIn');
    }
}