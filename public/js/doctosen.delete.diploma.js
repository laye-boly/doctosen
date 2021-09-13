const forms = Array.from(document.forms); // retourne toutes les formulaires



forms.forEach(form => {
    form.addEventListener('submit', e => {
            e.preventDefault();
           
            const diplomaNumber = document.getElementById('diploma-number').textContent;

            let decision = confirm(`Il ne vous reste que ${diplomaNumber} diplôme(s).
            Si vous supprimez tous vos diplômes, vous ne pourrez plus continuer à 'utiliser Doctosen`);

            if(decision){
                form.submit();
            }
    });
});