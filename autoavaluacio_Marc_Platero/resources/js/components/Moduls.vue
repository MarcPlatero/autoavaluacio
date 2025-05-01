<template>
    <div>
        <table class="table">
            <thead>
                <p class="h3">
                    Els teus mòduls
                </p><br>
                <p class="h5">
                    Selecciona el mòdul del que et vols avaluar:
                </p><br>
                <tr>
                    <!-- <th scope="col">Codi</th>
                    <th scope="col">Sigles</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Actiu</th> -->
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-for="modul in moduls">
                    <td>{{ modul.codi }}</td>
                    <td>{{ modul.sigles }}</td>
                    <td>{{ modul.nom }}</td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" :id="'actiu-' + modul.codi" :checked="modul.actiu" disabled />
                            <label class="custom-control-label" :for="'actiu-' + modul.codi"></label>
                        </div>
                    </td>
                </tr> -->

                <div v-for="modul in moduls" class="alert alert-secondary mb-3 modul" @click="mostrarRDAyCDE(modul.id, modul.codi, idUsuari)">
                    {{modul.codi}} - {{modul.nom}}
                </div>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tipoUsuario:0,
            idUsuari:0,
            moduls:[],
            modul:{}
        }
    },
    methods: {
        mostrarRDAyCDE(idModul, codiModul, idUsuari) 
        {
            if(this.tipoUsuario===3)
            {
                window.location.href = `/DAW/M07/autoavaluacio_Marc_Platero/public/resultatsAprenentatge?idModul=${idModul}&codiModul=${codiModul}&idAlumne=${idUsuari}`
            }
            else
            {
                window.location.href = 'veureAutoavaluacions?idModul='+idModul+"&codiModul="+codiModul;
            }
            
        },
        obtenerTipoDelUsuario()
            {
                const me=this
                axios
                    .get("recuperarTipusUsuari")
                    .then(response=>{
                        me.tipoUsuario=response.data.tipus
                        me.obtenerIdDelUsuario()
                    })
                    .catch(error=>{
                    })
            },
        obtenerIdDelUsuario()
        {
            const me=this
            axios
                .get("recuperarIdUsuari")
                .then(response=>{
                    me.idUsuari=response.data.id
                    me.obtenerModulsMatriculats()
                })
                .catch(error=>{
                })
        },
        obtenerModulsMatriculats() {
            const me = this
            axios
                .get(`/api/usuaris/${me.idUsuari}/moduls`)
                .then(response => {
                    me.moduls = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },
    created() {
        this.obtenerTipoDelUsuario();
    },

}
</script>

<style scoped>

</style>
