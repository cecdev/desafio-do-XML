
if(Desafio.user){
    // console.log(`App.Entities.User.${Desafio.user}`);
    Echo.private(`App.Entities.User.${Desafio.user}`)
        .notification(notification => {
            if(notification.type === "App\\Notifications\\ZipGenerate" && Desafio.user === notification.data.xmlctl.users_id){
                swal({
                    title: "Olá, que a força esteja com você!",
                    text: "Seu arquivo zip foi gerado com sucesso! Acesse a seção de downloads para baixar seu aquivo. "+notification.data.xmlctl.name,
                    icon: "success",
                    button: "OK!",
                });
            }

           // console.log(notification);
        });
}

