 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
        var V1,V2,V3;
        V1 = V2 = V3 = false;
	//Walidacja imienia
	$('#imie').on('blur', function() {
		var input = $(this);
		var name_length = input.val().length;
		if(name_length >= 3 && name_length <= 15){
                        V1 = true;
                        input.next('.komunikat').text("");
		}
		else{
			input.next('.komunikat').text("Imie powino mieć więcej niż 2 i mniej niż 16 znaków!");
                        
			
		}
	});
		
	//Walidacja nazwiska
	$('#nazwisko').on('blur', function() {
		var input = $(this);
		var sur_name = input.val();
		if(sur_name){
                        V2 = true;
                        input.next('.komunikat').text("");
                        
                }
		else{
			input.next('.komunikat').text("Nie wpisano Nazwiska");
		}
	});	
	
	//Walidacja wiadomości
	$('#mess').on('blur', function() {
		var input = $(this);
		var message = $(this).val();
		if(message){
			input.next('.komunikat').text("");
                        V3 = true;
                }
		else{
			input.next('.komunikat').text("Wiadomość nie może być pusta!");
		}   
	});
        
        
	
	//Po próbie wysłania formularza
		$('#button').click(function(event){
			
			if(V1 === true && V2 === true  && V3 === true ){
				alert("Pomyślnie wysłano formularz.");	
			}
			else {
				event.preventDefault();
				alert("Uzupełnij wszystkie pola!");
                                
                                
			}
		});
});