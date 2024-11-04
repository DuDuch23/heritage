const taille = 50; // Taille de la grille
const matrice = Array.from({ length: taille }, () => Array(taille).fill(false));
const gridElement = document.getElementById('grid');
let intervalId;
let lastTime = 0; // Variable pour stocker le temps de la dernière exécution
let iterationCount = 0; // Compteur d'itérations

function creerGrille() {
    gridElement.innerHTML = ''; // Réinitialiser la grille
    for (let i = 0; i < taille; i++) {
        for (let j = 0; j < taille; j++) {
            const cellule = document.createElement('div');
            cellule.classList.add('cellule');
            cellule.dataset.x = i;
            cellule.dataset.y = j;
            cellule.addEventListener('click', () => toggleCellule(i, j));
            gridElement.appendChild(cellule);
        }
    }
}

function toggleCellule(x, y) {
    matrice[x][y] = !matrice[x][y]; // Inverser l'état de la cellule
    mettreAJourGrille();
}

function mettreAJourGrille() {
    const cellules = document.querySelectorAll('.cellule');
    cellules.forEach(cellule => {
        const x = cellule.dataset.x;
        const y = cellule.dataset.y;
        cellule.classList.toggle('cellule-vivante', matrice[x][y]);
    });
}

function calculerVoisins(x, y) {
    const voisins = [
        [x - 1, y - 1], [x - 1, y], [x - 1, y + 1],
        [x, y - 1],               [x, y + 1],
        [x + 1, y - 1], [x + 1, y], [x + 1, y + 1],
    ];
    return voisins.filter(([vx, vy]) => vx >= 0 && vy >= 0 && vx < taille && vy < taille)
                   .filter(([vx, vy]) => matrice[vx][vy]).length;
}

function evolution() {
    const nouvelleMatrice = Array.from({ length: taille }, () => Array(taille).fill(false));

    const startTime = performance.now(); // Démarrer le chronomètre

    for (let i = 0; i < taille; i++) {
        for (let j = 0; j < taille; j++) {
            const voisinsCount = calculerVoisins(i, j);
            if (matrice[i][j]) { // Cellule vivante
                if (voisinsCount < 2 || voisinsCount > 3) {
                    nouvelleMatrice[i][j] = false; // Meurt
                } else {
                    nouvelleMatrice[i][j] = true; // Survit
                }
            } else { // Cellule morte
                if (voisinsCount === 3) {
                    nouvelleMatrice[i][j] = true; // Revient à la vie
                }
            }
        }
    }

    // Mettre à jour la matrice principale
    for (let i = 0; i < taille; i++) {
        for (let j = 0; j < taille; j++) {
            matrice[i][j] = nouvelleMatrice[i][j];
        }
    }

    mettreAJourGrille();
    
    const endTime = performance.now(); // Arrêter le chronomètre
    const executionTime = endTime - startTime; // Calculer le temps d'exécution
    lastTime = executionTime;
    iterationCount++; // Incrémenter le compteur d'itérations
    afficherPerformance();
}

function afficherPerformance() {
    document.getElementById('execution-time').textContent = lastTime.toFixed(2); // Afficher le temps d'exécution
    const iterationsPerSecond = (iterationCount / ((lastTime / 1000) || 1)).toFixed(2); // Calculer les itérations par seconde
    document.getElementById('iterations-per-second').textContent = iterationsPerSecond;
}

document.getElementById('start').addEventListener('click', () => {
    if (!intervalId) {
        intervalId = setInterval(evolution, 100); // Exécuter l'évolution toutes les 100 ms
        iterationCount = 0; // Réinitialiser le compteur d'itérations
    }
});

document.getElementById('stop').addEventListener('click', () => {
    clearInterval(intervalId);
    intervalId = null;
});

document.getElementById('clear').addEventListener('click', () => {
    matrice.forEach(row => row.fill(false));
    mettreAJourGrille();
});

document.getElementById('random').addEventListener('click', () => {
    matrice.forEach((row, i) => {
        row.forEach((_, j) => {
            matrice[i][j] = Math.random() > 0.7; // Remplir aléatoirement la grille
        });
    });
    mettreAJourGrille();
});

// Initialiser la grille
creerGrille();