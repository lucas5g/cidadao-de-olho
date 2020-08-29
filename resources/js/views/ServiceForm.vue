<template>
  <div id="container">
    <!-- <div class="d-flex justify-content-center aling-itens-center bg-primary h-100"> -->
    <Navbar />
    <Header :text="header" />
    <main>
      <p v-if="!service">Carregando ....</p>
      <template v-else>
        <div id="delete">
          <button id="btn-delete" v-if="idService" @click="handleDelete">Excluir Serviço</button>
        </div>
        <form @submit="handleSubmit">
          <Input label="Cliente" v-model="service.client" />

          <Input label="Vendedor" v-model="service.salesman" />

          <TextArea label="Descrição" v-model="service.description" />

          <Input label="Valor" v-model="service.price" v-money="money" />

          <div class="input-block">
            <button class="button" type="submit" v-bind:disabled="btn.status">{{btn.label}}</button>
            <router-link class="button" type="submit" to="/servicos/listar">Cancelar</router-link>
          </div>
        </form>
      </template>
    </main>
    <Footer />
    <!-- </div> -->
  </div>
</template>

<script>
import api from "../services/api";
import Input from "../components/Input";
import TextArea from "../components/TextArea";
import Header from "../components/Header";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { VMoney } from "v-money";
// import money from "v-money"
export default {
  name: "ServiceList",
  components: {
    Input,
    TextArea,
    Header,
    Navbar,
    Footer,
  },
  data() {
    return {
      btn: { status: false, label: "Cadastrar" },
      header: "Cadastrar Serviço",
      service: '',
      // service: {
      //   // client: "João vinicios",
      //   // salesman: "Rodrigo Junior",
      //   // description: "Troca das pastilhas",
      //   // price: "1350.00",
      // },
      idService: this.$route.params.id,
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        precision: 2,
        masked: false /* doesn't work with directive */,
      },
    };
  },
  methods: {
    async handleSubmit(event) {
      event.preventDefault();
      const price = this.service.price
        .replace("R$", "")
        .replace(".", "")
        .replace(",", ".");
      // .toLocaleString("en-US");

      const newService = {
        client: this.service.client,
        salesman: this.service.salesman,
        description: this.service.description,
        price,
      };

      if (this.idService === undefined) {
        this.btn = { status: true, label: "Cadastrando...." };

        try {
          await api.post("services", newService);
          this.$router.push("/servicos/listar");
        } catch (err) {
          window.alert("Erro ao cadastrar");
          window.location.reload();
        }
        return;
      }

      try {
        this.btn = { status: true, label: "Editando...." };

        await api.put(`services/${this.idService}`, newService);
        window.alert("Editado com Sucesso");
        this.$router.push("/servicos/listar");
      } catch (err) {
        console.log(err);
        window.alert("Erro ao Editar");
        window.location.reload();
      }
      return;

      // console.log(this.service.value);
    },

    async handleDelete() {

      const confirm = window.confirm('Tem certeza em Excluir o Serviço !?')

      if(!confirm){

        return
      }

      try {
        await api.delete(`services/${this.idService}`);
        window.alert("Deletado com Sucesso");
        this.$router.push("/servicos/listar");
      } catch (err) {
        console.log(err);
        window.alert("Erro ao Excluir");
        window.location.reload();
      }
    },
  },
  mounted() {
    if (this.idService === undefined) {
      this.service = {
        client: "",
        salesman: "",
        description: "",
        price: "",
      };
      return;
    }
    (async () => {
      try {
        const { data } = await api.get(`services/${this.idService}`);
        this.service = data;
      } catch (err) {
        this.$router.push("/servicos/listar");
      }
    })();
    this.header = "Editar Serviço";
    this.btn = {
      label: "Editar",
    };
  },
};
</script>
<style scoped>
main {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
form {
  width: 100%;
}

form .input-block {
  /* background: red; */
  width: 100%;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  column-gap: 2rem;
}

form .input-block button {
  width: 100%;
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
  cursor: pointer;
  padding: 0.7rem;
  border-radius: 5px;
  font-weight: 500;
  font-size: 1rem;
  border: 1px solid transparent;
}
form .input-block a {
  width: 100%;
  color: #fff;
  background-color: #545b62;
  border-color: #545b62;
  cursor: pointer;
  padding: 0.7rem;
  border-radius: 5px;
  font-weight: 500;
  text-decoration: none;
  font-size: 1rem;
  border: 1px solid transparent;
  display: block;
  text-align: center;
}

#delete {
  width: 100%;
  display: flex;

  flex-direction: column;
  /* justify-content: end; */
  align-items: flex-end;
}
#btn-delete {
  width: 10rem;
  padding: 0.7rem;
  background: red;
  border: 1px solid transparent;
  font-size: 1rem;
  font-weight: 500;
  float: right;
  color: #fff;
  cursor: pointer;

  /* font */
}
</style>