# Assesment PHP 

Anda diminta untuk membuat aplikasi task to do sederhana yang memungkinkan
pengguna untuk membuat daftar tugas, mengedit deskripsi tugas, menandai tugas yang
telah selesal, dan menghapus tugas. Dengan kriteria sebagal berikut:  
  
- Sistem ini harus menyimpan data ke dalam database menggunakan PDO
- Sistem ini harus menggunakan authentikasl (Login, logout) menggunakan implementasi  
  - Cookle
- Menggunakan Object Oriented dan harus terdapat Implementasi berikut:  
  - Menggunakan namespace  
  - Magic method  
  - Overriding method
  - Interface & Abstract
  - Collection
- Mengimplementasikan Security seperti berikut:  
  - Handle XSS menggunakan fitering/sanitizing  
  - Handle CSRF attack
  - Handle SQL Injection all query  
- Tugas bisa menambahkan attachment, dan harus di implementasi  
  - Validasi size  
  - Validasi extension  
- Terdapat API List, Create, Edit, Delete yang dipublish dengan kriteria:  
  - Tanpa session
  - Menggunakan HTTP Auth  
  - Input dan output dengan format json  
  - Menggunakan error handling  
  - Validasi variable input seperti data mandatory, atau data dengan tipe khusus  
  


Note:  
- Hasil kodingan dll push ke gitlab pribadi,  
- Yang dikumpulkan ke LMS berupa screenshot program dan screenshot apl postman dengan kriteria seperti berikut:
  - Sertakan link github public-nya
  - Screen shot berupa positif case (sukses) dan negatif case (gagal validasMain2)
 
# Pengumpulan Tugas 

### Login 

<details>
<summary>Login negativ case</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/989bf1f0-98c8-4169-b02a-c328381a57b8)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/b90b43fa-9db9-4971-a671-1c22d0da23f9)

</details>

<details>
<summary>Login positiv case</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/a4b3b97b-eeaa-43c6-8a8b-b467acd2108e)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/2cbaf8c0-8967-426d-9415-a77e73251153)

</details>

### Mengelola daftar tugas

<details>
<summary>Membuat daftar tugas</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/22344f86-af53-4d67-b11c-a409eacaf487)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/eda3c2c0-c13c-45b2-8c56-553916b5e6a2)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/b6e16d79-df5b-44cb-9b42-ea282bd17c93)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/8af8d993-64c6-4b2b-b7f0-67935267f099)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/fe95073b-c85b-480f-bec4-9b473f1f881a)

</details>

<details>
<summary>Meng-Edit daftar tugas</summary>

![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/531d4f69-59dd-4c55-80d3-22a869b793a0)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/9afe23e0-e64c-434b-94f2-c19d307405a3)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/7927c711-e0e2-4745-9652-6674b6e6440a)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/d96e47b1-3702-4e7b-8bf2-c80833a479a1)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/15031659-25ee-4dca-8d21-ca3b3e2f20cf)

</details>

<details>
<summary>Menandai tugas selesai (completed)</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/412f4ede-9798-4845-a077-eee219239973)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/b1e21a5d-1dd6-4e7f-95ed-0cffa3ce3381)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/d7f641f6-3002-4f82-9cf0-b23e731bef20)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/07506a24-6520-4de6-bae8-9bf2b4618fb1)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/46798c8f-7968-4153-b9a4-df0809a6b202)

</details>

<details>
<summary>Menghapus tugas</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/9ebcf150-e04c-4159-b81e-af81ba744057)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/1ff53ca5-e021-4158-bc4a-ac16232e187f)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/ee9f92bb-6a2f-4492-9c42-1e4ba8793969)

</details>


### Menambahkan attachment 

<details>
<summary>Validasi size</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/2c0259f4-ecf6-42f7-992e-ab44b7ac1a49)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/e7f33323-afe4-4d12-99d0-068badcd3669)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/71ea6ca5-4dbf-4923-ab6e-800955dba7d9)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/b86ce760-c75d-4edc-8e70-328722d189fb)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/697703fb-b600-40c7-af23-900275fceb35)

</details>

<details>
<summary>Validasi extension</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/ae429b36-51f7-4dbd-bec0-845505b963d6)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/631c0147-fecb-4855-92f7-849e8e2418df)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/57309659-0fd6-482b-8d5c-42900521e48c)

</details>

<details>
<summary>Upload positiv case</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/7a2c85b5-1c92-4c18-8b92-2ab4a26383b2)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/1f51d06a-0291-4b76-9928-c186af4878d1)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/d9acdc5a-41f1-40e6-9f82-7696527b84b9)

</details>

### Api list, create, edit, delete 

<details>
<summary>Api list</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/3c160907-0080-4414-b5ed-74e7e3ce50e6)

</details>

<details>
<summary>create</summary>
  
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/273bfdf5-1d35-4d17-b5cf-daf620fc9db8)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/bd927ab8-11e9-4779-b522-dd3ed1387553)


</details>

<details>
<summary>update</summary>

![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/2cc13d8b-853f-448e-a2da-d942bfc236dd)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/5df10ccd-e758-42f2-859e-edea630688f4)

</details>

<details>
<summary>delete</summary>

  ![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/0039d445-f2df-4108-94f4-a0bac944ce77)
  ![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/a653bd1c-206c-4e92-a8e2-ab899036ba85)

</details>

<details>
<summary>Negativ case invalid basic auth</summary>

![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/422e049d-881b-43c2-b2eb-50ef4d61dc2e)

</details>

<details>
<summary>validasi data mandatory negitv case</summary>

![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/a0260e16-4544-47ea-b47f-c32b94326c4a)
![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/a3d943ea-e6bd-42d4-abd9-e41eb46bc906)


</details>

<details>
<summary>validasi data mandatory positiv case</summary>

![image](https://github.com/Zaidzularsya/tugas-assesment-php/assets/85419185/8e8f702f-1ae4-481f-8684-35b3236365c2)

</details>



