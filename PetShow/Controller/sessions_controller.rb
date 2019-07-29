class SessionsController < ApplicationController
  layout false
  
  def new
    
  end
  
  def create
    usuario = Usuario.find_by(email: params[:session][:email].downcase)
    if usuario && usuario.authenticate(params[:session][:password])
      session[:usuario_id] = usuario.id
      flash[:success] = "Login efetuado!"
      redirect_to usuario_path(usuario)
    else
      flash.now[:danger] = "As informações do login estão incorretas!"
      render 'new'
    end    
  end
  
  def destroy
    session[:usuario_id] = nil
    flash[:success] = "Logout efetuado!"
    redirect_to login_path
  end
end