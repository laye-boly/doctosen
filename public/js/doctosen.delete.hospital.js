const forms = Array.from(document.forms); // retourne toutes les formulaires



forms.forEach(form => {
    form.addEventListener('submit', e => {
            e.preventDefault();
           
            const hospitalNumber = document.getElementById('hospital-number').textContent;

            let decision = confirm(
`Il ne vous reste que ${hospitalNumber} structures sanitaire.Si vous supprimez tous vos structures sanitaire, 
vous ne pourrez plus continuer à 'utiliser Doctosen en tant que professionel de santé ou structure sanitaire`);

            if(decision){
                form.submit();
            }
    });
});