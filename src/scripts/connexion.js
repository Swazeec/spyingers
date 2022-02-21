let email = document.getElementById('email')
let password = document.getElementById('password')
let submitBtn = document.getElementById('lgSubmit')

const emailRgx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
const passRgx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@]{8,}$/
let error=''

function verifEmail(email){
    if(email === '' || email.length > 60 || !emailRgx.test(email)){
        error += 'Email invalide !\n'
    }
}

function verifPass(password){
    if (password === "" || password.length > 50 || !passRgx.test(password)){
        error += 'Mot de passe invalide !'
    }
}


submitBtn.addEventListener('click', function(event){
    verifEmail(email.value)
    verifPass(password.value)
    if(error !==''){
        alert(error)
        error=''
        event.preventDefault()
    }
    else {
      document.forms["connexion"].submit();
    }

})