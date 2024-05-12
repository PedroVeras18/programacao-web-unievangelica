import { CarsRepository } from '@/repositories/cars-repository'
import { Car } from '@prisma/client'
import { ResourceNotFoundError } from './errors/resource-not-found-error'

interface GetByIdCarUseCaseRequest {
  carId: string
}

interface GetByIdCarUseCaseResponse {
  car: Car
}

export class GetByIdCarUseCase {
  constructor(private carsRepository: CarsRepository) {}

  async execute({
    carId,
  }: GetByIdCarUseCaseRequest): Promise<GetByIdCarUseCaseResponse> {
    const car = await this.carsRepository.findById(carId)

    if (!car) {
      throw new ResourceNotFoundError()
    }

    return {
      car,
    }
  }
}
