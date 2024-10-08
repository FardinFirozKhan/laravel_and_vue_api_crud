<template>
  <div class="card">
    <div class="card-header">
      <h4>
        Students
        <router-link to="/students/create" class="btn btn-primary float-end"
          >Add Student</router-link>
      </h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Course</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody v-if="this.students.length > 0">
          <tr v-for="(students,index) in this.students" :key="index">
            <td>{{ students.id }}</td>
            <td>{{ students.name }}</td>
            <td>{{ students.email }}</td>
            <td>{{ students.course }}</td>
            <td>{{ students.phone }}</td>
            <td>
              <router-link :to="{ path:'/students/'+students.id+'/edit'}" class="btn btn-success me-2"
          >Update</router-link>
          <button class="btn btn-danger" @click="deleteStudent(students.id)">Delete</button>
            </td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr colspan="6">Loading Data................</tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "students",
  data() {
    return {
      students: [],
    };
  },
  mounted() {
    this.getStudents()
  },
  methods: {

    getStudents() {
      axios.get("http://127.0.0.1:8000/api/students").then((res) => {
        this.students = res.data.students;
        console.log(this.students);
      });
    },
    deleteStudent(id){
      axios.delete(`http://127.0.0.1:8000/api/students/${id}/delete`).then((res) => {
        
        console.log(id);
         this.getStudents()
      });
    }
  },
};
</script>
