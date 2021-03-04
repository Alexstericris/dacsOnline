export default class PlayerApi{
    constructor(map) {
        this.map = map;
    }

    async getPlayers() {
        return axios.get('/api/map/players',{
            params:{
                'map': this.map
            }
        })
    }
}
