function showDetails(pokemonId) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalImage').src = data.sprites.front_default;
            document.getElementById('modalName').textContent = data.name.toUpperCase();
            document.getElementById('modalTypes').textContent = data.types.map(t => t.type.name).join(', ');
            document.getElementById('modalHeight').textContent = data.height;
            document.getElementById('modalWeight').textContent = data.weight;
            document.getElementById('modalAbilities').textContent = data.abilities.map(a => a.ability.name).join(', ');

            const statsList = document.getElementById('modalStats');
            statsList.innerHTML = '';
            data.stats.forEach(stat => {
                const li = document.createElement('li');
                li.textContent = `${stat.stat.name}: ${stat.base_stat}`;
                statsList.appendChild(li);
            });

            document.getElementById('pokemonModal').style.display = 'flex';
        });
}

function closeModal() {
    document.getElementById('pokemonModal').style.display = 'none';
}