using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Configuration;
using System.Linq;
using System.Web;

namespace AppLoginAutenticacao.Models
{
    public class Usuario
    {
        MySqlConnection Conexao = new MySqlConnection(ConfigurationManager.ConnectionStrings["conexao"].ConnectionString);
        MySqlCommand comand = new MySqlCommand();

        public int UsuarioID { get; set; }

        [Required]
        [MaxLength(50)]
        public string UsuNome { get; set; }

        [Required]
        [MaxLength(50)]
        public string Login { get; set; }

        [Required]
        [MaxLength(100)]
        public string Senha { get; set; }

        public void InsertUsuario(Usuario usuario)
        {
            Conexao.Open();
            comand.CommandText = "call spInsertUsuario(@UsuNome, @Login, @Senha);";
            comand.Parameters.Add("@UsuNome", MySqlDbType.VarChar).Value = usuario.UsuNome;
            comand.Parameters.Add("@Login", MySqlDbType.VarChar).Value = usuario.Login;
            comand.Parameters.Add("@Senha", MySqlDbType.VarChar).Value = usuario.Senha;
            comand.Connection = Conexao;
            comand.ExecuteNonQuery();
            Conexao.Close();
        }

        public string SelectLogin(string vLogin)
        {
            Conexao.Open();
            comand.CommandText = "call spSelectLogin(@Login);";
            comand.Parameters.Add("@Login", MySqlDbType.VarChar).Value = vLogin;
            comand.Connection = Conexao;
            string Login = (string)comand.ExecuteScalar();
            Conexao.Close();

            if (Login == null)
                Login = "";

            return Login;
        }
        public Usuario SelectUsuario(string vLogin)
        {
            Conexao.Open();
            comand.CommandText = "call spSelectUsuario(@Login);";
            comand.Parameters.Add("@Login", MySqlDbType.VarChar).Value = vLogin;
            comand.Connection = Conexao;

            var readUsuario = comand.ExecuteReader();
            var TempUsuario = new Usuario();

            if (readUsuario.Read())
            {
                TempUsuario.UsuarioID = int.Parse(readUsuario["UsuarioID"].ToString());
                TempUsuario.UsuNome = readUsuario["UsuNome"].ToString();
                TempUsuario.Login = readUsuario["Login"].ToString();
                TempUsuario.Senha = readUsuario["Senha"].ToString();
            }
            readUsuario.Close();
            Conexao.Close();

            return TempUsuario;
        }

        public void UpdateSenha(Usuario usuario)
        {
            Conexao.Open();
            comand.CommandText = "call spUpdateSenha(@Login, @Senha);";
            comand.Parameters.Add("@Login", MySqlDbType.VarChar).Value = usuario.Login;
            comand.Parameters.Add("@Senha", MySqlDbType.VarChar).Value = usuario.Senha;
            comand.Connection = Conexao;
            comand.ExecuteNonQuery();
            Conexao.Close();
        }
    }
}