$(document).ready(function(){   

    $(document).on('click','#bt-login', function(e){
        e.preventDefault();
        $('#modal-login').modal('show');
    });

    $(document).on('click','#bt-regein', function(e){
        e.preventDefault();
        $('#modal-regein').modal('show');
    });

    $(document).on('click','#bt-cancel-1', function(e){
        e.preventDefault();
        $('#modal-login').modal('hide');
    });
    $(document).on('click','#bt-cancel-2', function(e){
        e.preventDefault();
        $('#modal-regein').modal('hide');
    });

    $(document).on('click','#btnPassword', function(e){
        // step 1
            
    });

    

})

const ipnElement = document.querySelector('#ipnPassword')
const btnElement = document.querySelector('#btnPassword')
const btIcon = document.querySelector('#icopass')

// step 2
btnElement.addEventListener('click', function() {
    // step 3
    const currentType = ipnElement.getAttribute('type')
    // step 4
    ipnElement.setAttribute('type', currentType === 'password' ? 'text' : 'password')
    btIcon.classList.toggle('bi-eye')
});

const ipnElement2 = document.querySelector('#ipnPassword2')
const btnElement2 = document.querySelector('#btnPassword2')
const btIcon2 = document.querySelector('#icopass2')

// step 2
btnElement2.addEventListener('click', function() {
    // step 3
    const currentType2 = ipnElement2.getAttribute('type')
    // step 4
    ipnElement2.setAttribute('type', currentType2 === 'password' ? 'text' : 'password')

    btIcon2.classList.toggle('bi-eye')
});