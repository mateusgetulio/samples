class SessionsController < ApplicationController
  # Prevent the layout from being inherited
  layout false
  
  # User login method
  def create
    # Find user
    usuario = Usuario.find_by(email: params[:session][:email].downcase)
    if usuario && usuario.authenticate(params[:session][:password])
      # Store the user in the session
      session[:usuario_id] = usuario.id
      flash[:success] = "Login efetuado!"
      # Redirect to the user dashboard
      redirect_to usuario_path(usuario)
    else
      # Error treatment
      flash.now[:danger] = "As informações do login estão incorretas!"
      render 'new'
    end    
  end
  
  # Logout and destroy user session
  def destroy
    session[:usuario_id] = nil
    flash[:success] = "Logout efetuado!"
    # Redirect to the login dashboard
    redirect_to login_path
  end
end