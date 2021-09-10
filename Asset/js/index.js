
      
        $(".inventaire").load("inventaire")
        
        $('.inventaire').css('display','none');
        
        let btninventaire = document.getElementById('btninventaire');
            let overlay = document.getElementById('inventaire');
            btninventaire.addEventListener('click',openModal);
            function openModal() {
                overlay.style.display='block';
            }
        
        function fermerpopup(){   
            $('.inventaire').css('display','none');
        }

        $(function(){
            $( ".inventaire" ).draggable({
                containment: "body",
            });
        });
