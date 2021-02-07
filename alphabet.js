/**
*
* /alphabet.js
*
* Скрипт управления алфавитом игрока.
*
*/

    let alphabetBlock = document.getElementById('alphabet');
    let letters = alphabetBlock.querySelectorAll('span.letter');
    let alphabetField = document.getElementById('alphabet-field');
    let alphabetClassesArray = [];
    let alphabetClassesString = '';

    letters.forEach(function(letter) {
      alphabetClassesArray.push(letter.classList[1]);
      alphabetClassesString = alphabetClassesArray.join(', ');
      alphabetField.value = alphabetClassesString;
    });

    letters.forEach(function(letter, index){
      letter.addEventListener('click', function(){
        switch (true) {
          case this.classList.contains('uncertain'):
            this.classList.remove('uncertain');
            this.classList.add('included');
            break;
          case this.classList.contains('included'):
            this.classList.remove('included');
            this.classList.add('excluded');
            break;
          case this.classList.contains('excluded'):
            this.classList.remove('excluded');
            this.classList.add('uncertain');
            break;
        }
        alphabetClassesArray[index] = this.classList[1];
        alphabetClassesString = alphabetClassesArray.join(', ');
        alphabetField.value = alphabetClassesString;
      });
    });

