class AdminController < ApplicationController
  layout "admin/default"
  before_action :require_user
 
  def index
    
  end

end
