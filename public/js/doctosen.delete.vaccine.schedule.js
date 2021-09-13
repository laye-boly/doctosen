const forms = Array.from(document.forms); // retourne toutes les formulaires



forms.forEach(form => {
    form.addEventListener('submit', e => {
            e.preventDefault();
     
            let decision = confirm(`Confirmer la suppression de l'emploi du temps`);

            if(decision){
                form.submit();
            }
    });
});