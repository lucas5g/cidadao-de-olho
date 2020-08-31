<template>
  <div>
    <Header text="Rank de Gastos" />
    <main>
      <div id="input-block">
        <!-- <Input label="Ano" v-model="year" @input="handleSubmit" /> -->
        <Select
          label = "Ano"
          v-model="year"
          @input="handleSubmit"
          :options = "[
            { value: '2019', label: '2019'},
            { value: '2020', label: '2020'},
          ]"
          
         />
        <Select
          label = "Mês"
          v-model="month"
          @input="handleSubmit"
          :options = "[
            { value: '01', label: 'Janeiro'},
            { value: '02', label: 'Fevereiro'},
            { value: '03', label: 'Março'},
            { value: '04', label: 'Abril'},
            { value: '05', label: 'Maio'},
            { value: '06', label: 'Junho'},
            { value: '07', label: 'Julho'},
            { value: '08', label: 'Agosto'},
            { value: '09', label: 'Setembro'},
            { value: '10', label: 'Outubro'},
            { value: '11', label: 'Novembro'},
            { value: '12', label: 'Dezembro'},          
            
          ]"
          
         />

        <!-- <Input label="Mês" v-model="month" @input="handleSubmit" /> -->
      </div>

      <p v-if="indemnities.length === 0 && year != '' && month != '' ">Carregando...</p>

      <table v-else>
        <thead v-if="indemnities.length > 0">
          <tr>
            <th scope="col">N°</th>
            <th scope="col">Deputado</th>
            <th scope="col">Partido</th>
            <th scope="col">Valor (R$)</th>
            
          </tr>
        </thead>

        <tbody>
          <tr  v-for="(indemnity, index) in indemnities" :key="indemnity.deputy_id" >
            <!-- <th title="Clique para mais opções">
              <router-link :to="`/servicos/editar/${service.id}`">{{service.created_at | moment }}</router-link>
            </th>-->
            <th scope="row">{{ ++index }}</th>
            <td>{{indemnity.deputy.name }}</td>
            <td>{{indemnity.deputy.party }}</td>
            <td>{{indemnity.monthValue | toCurrency }}</td>
          </tr>
        </tbody>
        <!-- <p> {{ cont }} </p> -->
      </table>
    </main>
  </div>
</template>

<script>
import api from "../services/api";
import Header from "../components/Header";
import Input from "../components/Input";
import Select from "../components/Select"
// import moment from "moment";
// import useSWRV from "swrv";

export default {
  // name: "ServiceList",
  components: {
    Header,
    Input,
    Select
  },

  data() {
    return {
      indemnities: [],
      year: "",
      month: "",
      loading: false,
      cont: 1
    };
  },
  methods: {
    async handleSubmit() {
      const obj = {
        year: this.year,
        month: this.month,
      };
      // this.loading = true
      if (obj.year === "" || obj.month === "") {
        return false;
      }
      console.log(obj);

      const { data } = await api.get("indemnities", {
        params: obj,
      });

      console.log(data)
      this.indemnities = data;

      if(data.length === 0){
        window.alert("Nada cadastrado")
        window.location.reload()
        return
      }

      // console.log('bora add')

      // window.alert('Cadastrando as verbas indernizatórias')
      // const { status } = await api.post("indemnities", obj)
      // window.alert('Cadastrado com sucesso')

    },
  },
  mounted() {
    (async () => {
      const obj = {
        // year: 2020,
        // month: "07",
        year: "" ,
        month: "",
      };

      const { data } = await api.get("indemnities", {
        params:  obj ,
      });
      console.log(data);

      this.indemnities = data;
    })();
  },

  filters: {
    toCurrency: function (value) {
      const formatter = new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
        minimumFractionDigits: 2,
      });
      const valueFormated = formatter.format(value);
      return valueFormated.replace("R$", "");
    },
    // moment(date) {
  //     return moment(date).format("DD/MM/YY");
  //   },
  },
};
</script>


<style scoped>
table {
  border-collapse: collapse;
  width: 100%;
  table-layout: fixed;
}
th,
td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  word-wrap: break-word;
}
@media (min-width: 760px) {
  main #input-block {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 1rem;
  }
}
</style>