const aFilms = [
    { "titre": "La guerre des étoiles, un nouvel espoir",
      "épisode":"IV",                          
      "année": "1977",
      "acteurs": ["Mark Hamill", "Harrison Ford", "Carrie Fisher",  "Peter Cushing", "Alec Guinness"],
      "réalisateur": "Georges Lucas"  
     },

     { "titre": "L'empire contre-attaque",
       "épisode":"V",  
       "année": "1980",
       "acteurs": ["Mark Hamill", "Harrison Ford", "Carrie Fisher",        "Billie Dee Wiliams", "Anthony Daniels"],
       "réalisateur": "Irvin Kershner"    
     },

     { "titre": "Le retour du Jedi",
       "épisode":"VI",   
       "année": "1983",
       "acteurs": ["Mark Hamill", "Carrie Fisher", "Harrison Ford", "Billie Dee Wiliams", "Anthony Daniels"],
       "réalisateur": "Richard Marquand" 
     },

     { "titre": "La menace fantôme",
       "épisode":"I",   
       "année": "1999",
       "acteurs": ["Liam Neeson", "Ewan McGregor", "Natalie Portman", "Jake Lloyd"],
       "réalisateur": "Georges Lucas"
     }

]; // fermeture du tableau

console.log(aFilms[2].acteurs[1]);