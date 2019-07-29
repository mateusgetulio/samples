class UsuariosController < ApplicationController
  layout "admin/default"
  before_action :require_user
  before_action :set_usuario, only: [:edit, :update]
  before_action :list_usuarios
  
  def index
    render 'admin/usuarios/index'
  end

  def show
    render 'admin/usuarios/index'
  end
  
  def new
    @usuario = Usuario.new
    render 'admin/usuarios/new'
  end
  
  def create
    @usuario = Usuario.new(usuario_params)
    if @usuario.save
      session[:usuario_id] = @usuario.id
      flash[:success] = "Usuário cadastrado!"
      render 'admin/usuarios/index'
    else
      render 'admin/usuarios/new'
    end
  end
  
  def edit
    render 'admin/usuarios/edit'
  end
  
  def update
    if @usuario.update(usuario_params)
      flash[:success] = "Usuário editado!"
      render 'admin/usuarios/index'
    else
      render 'admin/usuarios/edit'
    end
  end
  
  def destroy
    @usuario = Usuario.find(params[:id])
    @usuario.destroy
    flash[:danger] = "Usuário excluído!"
    render 'admin/usuarios/index'
  end
  
  private

  def list_usuarios
    @usuarios = Usuario.all
  end
  
  def set_usuario
    @usuario = Usuario.find(params[:id])
  end
  
  def usuario_params
    params.require(:usuario).permit(:nome, :email, :password)  
  end
  
end